<?php

namespace src;

class Task8
{
    public function main($json): string
    {
        if (false === $this->isJson($json)) {
            throw new \InvalidArgumentException();
        }
        $decoded_json = json_decode($json, true);
        $text = '';
        foreach ($decoded_json as $key => $data) {
            if (\is_array($data)) {
                foreach ($data as $fKey => $fData) {
                    $text = $text.$fKey.': '.$fData;
                }
            } else {
                $text = $text.$key.': '.$data."\r\n";
            }
        }

        return $text;
    }

    public function isJson($json): bool
    {
        return \is_string($json) && (\is_object(json_decode($json)) || \is_array(json_decode($json)));
    }
}
