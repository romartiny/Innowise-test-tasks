<?php

namespace src;

class task8
{
    public function main(string $json): object|string
    {
        $decoded_json = json_decode($json, true);

        $keys = array_keys($decoded_json);

//        foreach ($parentArray as $childArray) {
//            foreach ($childArray as $value)
//            {
//                $decoded_json[] = $value;
//            }
//        }


//        for($i=0;$i<count($decoded_json);$i++)
//        {
//            if(is_array($decoded_json)) {
//                foreach ($decoded_json[$keys[$i]] as $key => $value) {
//                    echo $key . ": " . $value;
//                }
//            }
//        }



        foreach ($decoded_json as $key => $data1) {
            if(is_array($data1[4])) {
//                implode(" ",$decoded_json);
            } else {
                echo $key, ": ";
                echo $data1, "\n";
            }
        }
//        print_r($decoded_json);


        return print_r($decoded_json);
    }
}

$object = new Task8();
echo $object->main('{"Title": "The Cuckoos Calling", "Author": "Robert Galbraith","Detail": {"Publisher": "Little Brown"}}');
