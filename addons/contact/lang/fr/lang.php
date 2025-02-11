<?php

return [
    'title' => 'Contacts',
    'management_title' => 'Gestion des demandes de contacts',
    'management_description' => 'Liste de toutes les demandes de contacts',
    'show_title' => 'Détails du contact',
    'show_description' => 'Voir les détails de la demande de contact',
    'table' => [
        'id' => '#',
        'title' => 'Sujet',
        'email' => 'Email',
        'status' => 'Statut',
        'message' => 'Message',
        'created_at' => 'Créé le',
        'actions' => 'Actions'
    ],
    'actions' => [
        'view' => 'Voir',
        'delete' => 'Supprimer',
        'back' => 'Retour',
        'save' => 'Enregistrer',
        'delete_success' => 'La demande de contact a été supprimée avec succès',
        'update_success' => 'Le statut de la demande de contact a été mis à jour avec succès',
        'options' => 'Actions',
        'reply_email' => 'Répondre par email',
        'send_mail' => 'Envoyer un email',
        'store_success' => 'La demande de contact a été enregistrée avec succès'
    ],
    'status' => [
        'read' => 'Traité',
        'unread' => 'Non traité'
    ],
    'errors' => [
        'not_found' => 'La demande de contact n\'a pas été trouvée',
        'update_failed' => 'La mise à jour de la demande de contact a échoué'
    ],
    'confirm_delete' => 'Êtes-vous sûr de vouloir supprimer cette demande de contact ?',
    'status_updated_at' => 'Statut mis à jour le :date',
    'settings' => [
        'title' => 'Paramètres',
        'description' => 'Configurer les paramètres du module de contact',
        'general_settings' => 'Paramètres généraux',
        'security_settings' => 'Paramètres de sécurité',
        'media_settings' => 'Paramètres médias',
        'enable_captcha' => 'Activer le captcha',
        'enable_captcha_description' => 'Ajouter une protection supplémentaire contre les spams',
        'require_login' => 'Requérir une connexion',
        'require_login_description' => 'Les utilisateurs doivent être connectés pour envoyer un message',
        'page_image' => 'Image de la page',
        'click_to_upload' => 'Cliquez pour télécharger',
        'or_drag_and_drop' => 'ou glissez-déposez',
        'up_to_2mb' => 'jusqu\'à 2 Mo',
        'save_settings' => 'Sauvegarder les paramètres',
        'disabled' => 'Désactivé',
        'enabled' => 'Activé'
    ]
];
