<?php
/**
 * Generate API documentation.
 *
 * Run in command line with:
 *     php -f generate-api.docs.php
 *
 * Copy output into README.md
 */
$loader = require __DIR__ . '/vendor/autoload.php';
$loader->add('Basecamp\\Test\\', __DIR__ . '/tests');

$docs = new Generate_Docs();

$docs->checkSummaries();
$docs->generate();
$docs->save();

class Generate_Docs {

	/**
	 * @link  http://guzzle3.readthedocs.org/webservice-client/guzzle-service-descriptions.html#parameter-schema
	 * @var  array Guzzle service description.
	 */
	protected $service;

	/**
	 * @var string Generated docs Markdown
	 */
	protected $docs_markdown;

	/**
	 * Readme filename. Converted to full path on __construct()
	 * 
	 * @var string
	 */
	protected $readme_file = 'README.md';

	/**
	 * Markers for identifying start and end of API Calls to be replaced in readme file.
	 *
	 * @link( http://stackoverflow.com/a/4829998, Triple hyphen for Pandoc compatibility )
	 * 
	 * @var string
	 */
	protected $start_marker = '<!--- START API Generate with: php -f `generate-api-docs.php` -->';
	protected $end_marker = '<!--- END API -->';

	protected $tmpl_heading           = "\n### @summary \n\n";
	protected $tmpl_heading_tests     = "\n### Unit Test Coverage \n\nThe following service operations are not (yet) covered by unit tests:\n\n";

	protected $tmpl_code_block_start  = "```php \n";
	protected $tmpl_code_block_end    = "``` \n";

	protected $tmpl_method_without_params     = "\$response = \$client->@method(); \n";
	protected $tmpl_method_with_params_start  = "\$response = \$client->@method( array( \n";
	protected $tmpl_method_with_params_end    = ") ); \n";
	protected $tmpl_method_parameter          = "    '@param' => @example,  // @required @description \n";

	protected $tmpl_tests_bullet      = "* @method \n";

	/**
	 * Parameter code examples in order of priority.
	 *
	 * Note the use of single quotes within double quotes
	 * so that strings will output as valid PHP.
	 * 
	 * @var array
	 */
	protected $examples = array(
		// Parameter names
		'since'       => "'2012-03-24T11:00:00-06:00'",
		'description' => "'Example description'",
		'content'     => "'Example content'",
		'name'        => "'Example name'",
		'data'        => "file_get_contents( 'image.jpg' )",
		'mimeType'    => "'image/jpeg'",
		'attachments' => "array( array( 'token' => \$upload_token, 'name' => 'file.jpg' ) )",
		'assignee'    => "array( 'id' => 1234567, 'type' => 'Person' )",

		// Parameter types
		'string'      => "'example'",
		'integer'     => 1234567,
	);

	function __construct() {
		$this->service = require __DIR__ . '/src/Basecamp/Resources/service.php';
		$this->readme_file = __DIR__ . '/' . $this->readme_file;
	}

	/**
	 * Verify that all service operations have summaries set before continuing
	 */
	public function checkSummaries() {
		$need_summaries = array();

		foreach ( $this->service['operations'] as $method => $info ) {
			if ( ! isset( $info['summary'] ) ) {
				$need_summaries[] = $method;
			}
		}

		if ( ! empty( $need_summaries ) ) {

			echo PHP_EOL;
			echo 'Please set summaries for all operations to generate docs.' . PHP_EOL;
			echo 'The following operations are missing a \'summary\' value in service.php:' . PHP_EOL;

			foreach ( $need_summaries as $method ) {
				echo '	' . $method . PHP_EOL;
			}

			echo PHP_EOL;

			exit;

		}
	}

	/**
	 * Work out which serice operations still need unit tests written
	 */
	public function checkTestCoverage() {
		$tests_needed = array();

		foreach ( $this->service['operations'] as $method => $info ) {
			if ( ! method_exists( new Basecamp\Test\BasecampClientTest(), 'test' . ucfirst($method) ) ) {
				$tests_needed[] = $method;
			}
		}

		if ( ! empty( $tests_needed ) ) {

			// Test Coverage Heading
			echo $this->template( $this->tmpl_heading_tests, array() );

			foreach ( $tests_needed as $method ) {
				// Test Coverage Heading
				echo $this->template( $this->tmpl_tests_bullet, array('method' => $method) );
			}

		}
	}

	/**
	 * Output docs for each service operation in Markdown format.
	 */
	public function generate() {

		ob_start();

		foreach ( $this->service['operations'] as $method => $info ) {

			// Add method to info array for more convenient templates
			$info['method'] = $method;

			// Heading
			echo $this->template( $this->tmpl_heading, $info );

			// Code Block start
			echo $this->template( $this->tmpl_code_block_start, $info );

			if ( isset( $info['parameters'] ) ) {

				// Method call (with parameters) start
				echo $this->template( $this->tmpl_method_with_params_start, $info );

				// Parameters
				foreach ( $info['parameters'] as $param => $param_info ) {
					$param_info['param'] = $param;
					echo $this->template( $this->tmpl_method_parameter, $param_info );
				}

				// Method call end
				echo $this->template( $this->tmpl_method_with_params_end, $info );

			}else {
				
				// Method call (no parameters)
				echo $this->template( $this->tmpl_method_without_params, $info );

			}

			// Code Block end
			echo $this->template( $this->tmpl_code_block_end, $info );

		}

		$this->checkTestCoverage();

		$this->docs_markdown = ob_get_clean();

		return $this->docs_markdown;
	}

	public function save() {
		if ( ! isset( $this->docs_markdown ) ) {
			echo "\nPlease run \$this->generate() before \$this->save()";
			exit;
		}

		if ( ! is_readable( $this->readme_file ) || ! is_writable( $this->readme_file ) ) {
			echo "\nCould not read or write to readme file. Please check permissions.\n";
			echo "Readme path: {$this->readme_file}\n\n";
			exit;
		}

		$readme = file_get_contents( $this->readme_file );

		$this->insertWithMarkers( $this->readme_file, $this->docs_markdown );

		echo PHP_EOL . basename( $this->readme_file ) . ' updated.' . PHP_EOL . PHP_EOL;
	}

	/**
	 * Inserts an array of strings into a file (.htaccess ), placing it between
	 * BEGIN and END markers. Replaces existing marked info. Retains surrounding
	 * data. Creates file if none exists.
	 *
	 * @author  Unknown. Adapted from WordPress core.
	 * 
	 * @param string $filename
	 * @param string $marker
	 * @param string|array $insertion
	 * @return bool True on write success, false on failure.
	 */
	function insertWithMarkers( $filename, $insertion ) {

		if ( ! is_array( $insertion ) ) {
			$insertion = explode( "\n", $insertion );
		}

		if ( ! file_exists( $filename ) || is_writable( $filename ) ) {
			if ( ! file_exists( $filename ) ) {
				$markerdata = '';
			} else {
				$markerdata = explode( "\n", implode( '', file( $filename ) ) );
			}

			if ( !$f = @fopen( $filename, 'w' ) )
				return false;

			$foundit = false;
			if ( $markerdata ) {

				$state = true;

				foreach ( $markerdata as $n => $markerline ) {
					if (strpos($markerline, $this->start_marker) !== false) {
						$state = false;
					}

					if ( $state ) {
						if ( $n + 1 < count( $markerdata ) )
							fwrite( $f, "{$markerline}\n" );
						else
							fwrite( $f, "{$markerline}" );
					}

					if ( strpos( $markerline, $this->end_marker ) !== false) {
						fwrite( $f, $this->start_marker . "\n" );

						if ( is_array( $insertion ) ) {
							foreach ( $insertion as $insertline ) {
								fwrite( $f, "{$insertline}\n" );
							}
						}

						fwrite( $f, $this->end_marker . "\n" );
						$state = true;
						$foundit = true;
					}
				}
			}
			if ( ! $foundit ) {
				fwrite( $f, "\n" . $this->start_marker . "\n" );
				foreach ( $insertion as $insertline ) {
					fwrite( $f, "{$insertline}\n" );
				}
				fwrite( $f, $this->end_marker . "\n" );
			}

			fclose( $f );
			return true;

		}

		return false;

	}

	/**
	 * Replace @variables with values in template string.
	 * 
	 * @param  string $string Template string. @variable used for variables.
	 * @param  array $args   Array with keys as variable name, values as value
	 * @return string
	 */
	protected function template( $string, array $args ) {

		// Example data formats
		$string = str_replace( '@example', $this->getExample( $args ), $string );

		// Required or Optional
		$string = str_replace( '@required', ( empty( $args['required'] ) ? 'Optional.' : 'Required.' ), $string );

		// Vars from passed array
		foreach ( $args as $key => $value ) {
			if ( is_string( $value ) ) {
				$string = str_replace( '@' . $key, $value, $string );
			}
		}

		// Clear remaining variables
		$string = preg_replace( '/@[a-zA-Z0-9]+/', '', $string );

		return $string;
	}

	protected function getExample( array $args ) {
		if ( ! isset( $args['param'] ) ) {
			return false;
		}

		foreach ( $this->examples as $key => $code ) {
			if ( $key == $args['param'] || $key == @ $args['type'] ) {
				return $code;
			} 
		}

		return "''";
	}

}