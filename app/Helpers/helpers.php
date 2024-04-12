<?php

use Illuminate\Support\Carbon;

function setActive($routeName)
{
    return request()->routeIs($routeName) ? 'bg-cyan-500 text-white' : '';
}

function verifyAvatar($file)
{
    if ($file) {
        return $file->file_url;
    }

    return 'https://ui-avatars.com/api/?name=&color=7F9CF5&background=EBF4FF';
}


function setStatus($dish)
{
    return config('parameters.status')[$dish->status];
}

function setRole($dish)
{
    return config('parameters.roles')[$dish->role];
}

/**
 * Get the flag of the country
 * @param string $key Country key
 * @return string
 */
function getFlagCountry($key)
{
    $src = 'img/countries/' . $key . '.png';
    $fileExists = file_exists(public_path($src));
    return $fileExists ? asset($src) : asset('img/countries/500.png');
}

// CARBON

function getCurrentYear()
{
    return Carbon::now('America/Lima')->format('Y');
}

function getCurrentDateTime()
{
    return Carbon::now('America/Lima')->format('YYYY-MM-DD HH:mm');
}
