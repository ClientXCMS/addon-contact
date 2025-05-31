<?php

/*
 * This file is part of the CLIENTXCMS project.
 * This file is the property of the CLIENTXCMS association. Any unauthorized use, reproduction, or download is prohibited.
 * For more information, please consult our support: clientxcms.com/client/support.
 * Year: 2024
 */
return [
    'title' => 'Contacts',
    'pending' => 'Demandes de contact en attente',
    'description' => 'Traitez les demandes de contact de vos utilisateurs sur votre espace client.',
    'management_title' => 'Gestion des demandes de contacts',
    'management_description' => 'Liste de toutes les demandes de contacts',
    'show_title' => 'Détails du contact',
    'show_description' => 'Voir les détails de la demande de contact',
    'title_page' => 'Contactez-nous',
    'subject' => 'Sujet de la demande',
    'content_label' => 'Décrivez votre demande',
    'object_label' => 'Objet de la demande',
    'max_characters' => 'Limité à :max caractères',
    'send' => 'Envoyer la demande',
    'subtitle_page' => 'Nous serions ravis de recevoir vos messages. Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais.',
    'actions' => [
        'delete_success' => 'La demande de contact a été supprimée avec succès',
        'update_success' => 'Le statut de la demande de contact a été mis à jour avec succès',
        'reply_email' => 'Répondre par email',
        'send_mail' => 'Envoyer un email au client',
        'limit_error' => 'Vous avez déjà envoyé une demande de contact il y a moins de 5 minutes',
        'store_success' => 'La demande de contact a été enregistrée avec succès',
    ],
    'status' => [
        'read' => 'Traité',
        'unread' => 'Non traité',
    ],
    'webhook' => [
        'title' => 'Nouvelle demande de contact',
        'description' => 'Une nouvelle demande de contact a été reçue',
    ],
    'errors' => [
        'not_found' => 'La demande de contact n\'a pas été trouvée',
        'update_failed' => 'La mise à jour de la demande de contact a échoué',
    ],
    'status_updated_at' => 'Statut mis à jour le :date',
    'settings' => [
        'title' => 'Préférences de la page de contact',
        'description' => 'Configurez vos préférences pour la page de contact.',
        'security_settings' => 'Paramètres de sécurité',
        'media_settings' => 'Paramètres médias',
        'enable_captcha' => 'Activer le captcha',
        'enable_captcha_description' => 'Ajouter une protection supplémentaire contre les spams',
        'webhook' => 'Notifier une URL externe',
        'webhook_description' => 'Envoyer les demandes de contact à une URL externe',
        'subscribers' => 'Notifier des personnels',
        'subscribers_description' => 'Envoyer les demandes de contact à des personnels spécifiques',
        'require_login' => 'Requérir une connexion',
        'require_login_description' => 'Les utilisateurs doivent être connectés pour envoyer un message',
        'page_image' => 'Image de la page',
        'disabled' => 'Désactivé',
        'enabled' => 'Activé',
    ],
];
