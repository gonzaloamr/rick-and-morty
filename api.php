<?php

const API_BASE = 'https://rickandmortyapi.com/api';

function api_get(string $url): ?array
{
    $context = stream_context_create([
        'http' => ['timeout' => 10, 'ignore_errors' => false],
    ]);
    $body = @file_get_contents($url, false, $context);

    if ($body === false) {
        return null;
    }

    return json_decode($body, true);
}

function get_characters(array $ids): array
{
    return api_get(API_BASE . '/character/' . implode(',', $ids)) ?? [];
}

function get_character(int $id): ?array
{
    return api_get(API_BASE . '/character/' . $id);
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
