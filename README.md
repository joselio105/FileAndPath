# File and Path
Salvando e lendo dados em arquivos de maneira simplificada

## Como usar

## Como instalar

## Como testar

## Funcionalidades
```php
File::createPathIfNotExists(
    string $path
): void
```
```php
File::createPathIfNotExists(
    string $path
): void
```
```php
File::saveFile(
    string $filename, 
    string $content, 
    bool $update=false
): void
```
```php
File::saveOnJsonFile(
    string $filename, 
    array $dataStructure
): void
```
```php
File::saveOnDotEnvFile(
    string $filename, 
    array $dataStructure
): void
```
```php
File::readFile(
    string $filename
): string
```
```php
File:readJsonFile(
    string $filename
): array
```
```php
File:readFromDotEnvFile(
    string $filename
): array
```

## Exceções