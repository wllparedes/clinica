<?php


function verifyAvatar($file)
{
    if ($file) {
        return $file->file_url;
    }
    
    return 'https://ui-avatars.com/api/?name=&color=7F9CF5&background=EBF4FF';
}
