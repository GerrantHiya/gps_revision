<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Security2
{
    function generate_activation_key($email)
    {
        $secret = 'gerrant_glenda_071218'; // Ganti dengan secret kamu (harus dijaga kerahasiaannya)

        $raw = $email . $secret;

        // Hash dan ambil sebagian (misal 10 karakter awal dari hash)
        $hash = hash('sha256', $raw);
        $activation_key = substr(strtoupper($hash), 0, 15); // Bisa pakai strtolower kalau mau lowercase

        return $activation_key;
    }

    function verify_activation_key($email, $input_key)
    {
        return $this->generate_activation_key($email) === strtoupper($input_key);
    }
}
