<?php

return array(
    'serviceFullName'       => '37signals Basecamp API',
    'serviceAbbreviation'   => 'Basecamp API',
    'operations'            => array(
        'GetProjects' => array(
            'httpMethod' => 'GET',
            'uri'       => 'projects.json',
            'summary'   => 'Get all active projects'
        ),
        'GetProject' => array(
            'httpMethod' => 'GET',
            'uri'        => 'projects/{id}.json',
            'parameters' => array(
                'id' => array(
                    'location' => 'uri',
                    'description' => 'Project to retrieve by ID',
                    'required' => true
                )
            )
        ),
        'GetDocumentsByProject' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{id}/documents.json',
            'parameters' => array(
                'id' => array(
                    'location' => 'uri',
                    'description' => 'Retrieve documents for given project',
                    'required' => true
                )
            )
        ),
        'GetDocument' => array(
            'httpMethod' => 'GET',
            'uri' => 'projects/{projectId}/documents/{documentId}.json',
            'parameters' => array(
                'projectId' => array(
                    'location' => 'uri',
                    'description' => 'Project id',
                    'required' => true
                ),
                'documentId' => array(
                    'location' => 'uri',
                    'description' => 'Document Id',
                    'required' => true
                )
            )
        )
    )
);
