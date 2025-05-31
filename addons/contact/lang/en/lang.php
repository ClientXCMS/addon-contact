<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
return [
    'title' => 'Contacts',
    'management_title' => 'Contact Request Management',
    'management_description' => 'List of all contact requests',
    'show_title' => 'Contact Details',
    'show_description' => 'View contact request details',
    'table' => [
        'id' => '#',
        'title' => 'Subject',
        'email' => 'Email',
        'status' => 'Status',
        'message' => 'Message',
        'created_at' => 'Created at',
        'actions' => 'Actions',
    ],
    'actions' => [
        'view' => 'View',
        'delete' => 'Delete',
        'back' => 'Back',
        'save' => 'Save',
        'delete_success' => 'Contact request has been successfully deleted',
        'update_success' => 'Contact request status has been successfully updated',
    ],
    'status' => [
        'read' => 'Read',
        'unread' => 'Unread',
    ],
    'errors' => [
        'not_found' => 'Contact request not found',
        'update_failed' => 'Contact request update failed',
    ],
    'confirm_delete' => 'Are you sure you want to delete this contact request?',
    'status_updated_at' => 'Status updated at :date',
];
