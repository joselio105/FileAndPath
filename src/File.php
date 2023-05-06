<?php

namespace Plugse\FP;

use Plugse\FP\Exceptions\FileAlreadyExists;
use Plugse\FP\Exceptions\FileCannotBeOppend;
use Plugse\FP\Exceptions\FileCannotBeWritten;
use Plugse\FP\Exceptions\FileNotFound;
use Plugse\FP\Exceptions\FileCanNotBeRead;

class File
{

    const BROKE_LINE = "\n";

    public static function readJsonFile(string $filename): array
    {
        return json_decode(self::readFile($filename), JSON_PRETTY_PRINT);
    }

    public static function readFromDotEnvFile(string $filename): array
    {
        $response = [];
        $separator = "=";

        foreach(explode(self::BROKE_LINE, self::readFile($filename)) as $row){
			if(strlen($row)>0 AND strstr($row, $separator)){
				$brk = explode($separator, $row);
				$key = trim($brk[0]);
				$value = trim($brk[1]);
				$response[$key] = $value;
			}
        }

        return $response;
    }
    
    public static function readFile(string $filename): string
    {
        
        if(!file_exists($filename)){
            throw new FileNotFound($filename);
        }

        $fileContent = file($filename);
        if(!$fileContent){
            throw new FileCanNotBeRead($filename);
        }

        return implode(self::BROKE_LINE, $fileContent);
    }    

    public static function saveOnJsonFile(string $filename, array $dataStructure): void
    {
        self::saveFile(
            $filename,
            json_encode($dataStructure, JSON_PRETTY_PRINT),
            true
        );
    }

	public static function saveOnDotEnvFile(string $filename, array $dataStructure): void
	{
        $content = '';
        foreach($dataStructure as $key=>$value){
            $content .= "{$key}={$value}\n";
        }

        self::saveFile(
            $filename,
            $content,
            true
        );
	}

    public static function saveFile(string $filename, string $content, bool $update=false): void
    {
        self::createPathIfNotExists(dirname($filename));
        if(!$update){
            if(file_exists($filename)){
                throw new FileAlreadyExists($filename);
            }
        }

        if (!$handle = fopen($filename, 'w')) {
            throw new FileCannotBeOppend($filename);
        }

        if (fwrite($handle, $content) === FALSE) {
            throw new FileCannotBeWritten($filename);
        }

        fclose($handle);

        $action = $update ? 'atualizado' : 'criado';
    }

    public static function createPathIfNotExists(string $path): void
    {
        if(file_exists($path)){
            return;
        }
        
        $dir = '';
        foreach(explode('/', $path) as $dirPiece){
            if($dirPiece !== '.'){
                $dir .= "/{$dirPiece}";
                if(!file_exists($dir)){
                    mkdir($path, 0777, true);
                }
            }
        }
    }

}