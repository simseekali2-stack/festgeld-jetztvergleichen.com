@props(['keyName', 'fallback'])

<span>{{ config('settings.' . $keyName, $fallback) }}</span>