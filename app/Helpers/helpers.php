<?php

use Illuminate\Support\Carbon;

function setActive($routeName)
{
    return request()->routeIs($routeName) ? 'bg-adp text-white' : '';
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
    $src = 'images/countries/' . $key . '.png';
    $fileExists = file_exists(public_path($src));
    return $fileExists ? asset($src) : asset('images/countries/500.png');
}

/**
 * Get information about the appointment
 * @param string $fullName Full name of the patient
 * @param string $time Time of the appointment
 * @return string
 */
function getInfoAppointment($fullName, $time)
{
    return __('Patient') . ': ' . $fullName . '<br>' . __('Time') . ': ' . $time;
}

function getGenderForUser($gender)
{
    $gender = config('parameters.gender')[$gender];
    return __($gender);
}


// CARBON

function getCurrentYear()
{
    return Carbon::now('America/Lima')->format('Y');
}


function getDateForHumans($date)
{
    return Carbon::parse($date)->diffForHumans();
}

function getDateForHumansText($date)
{
    return Carbon::parse($date)->isoFormat('dddd D MMMM YYYY');
}


function getCurrentDateTime()
{
    return Carbon::now('America/Lima')->format('YYYY-MM-DD HH:mm');
}



// set language session

// documentation: https://www.cursosdesarrolloweb.es/blog/formas-de-desarrollar-un-sitio-web-multi-idioma-en-laravel

// get the default string language from config file
if (!function_exists('getCurrentStringLanguage')) {
    function getCurrentStringLanguage(string $language)
    {
        return config('languages.' . $language . '.language');
    }
}

// set the selected language in the session
if (!function_exists('setLanguageSession')) {
    function setLanguageSession(string $language)
    {
        if (array_key_exists($language, config('languages'))) {
            session()->put('language', $language);
        }
    }
}

// set the current language for app
if (!function_exists('setCurrentLanguage')) {
    function setCurrentLanguage()
    {
        if (session('language')) {
            $configLanguage = config('languages')[session('language')];
            setlocale(LC_TIME, $configLanguage['lc']);
        } else {
            session()->put('language', config('app.fallback_locale'));
            setlocale(LC_TIME, 'es_ES');
        }
        app()->setLocale(session('language'));
    }
}


function languageNow()
{
    $lang =  session('language');
    return config('parameters.languages')[$lang];
}
