# File and Path

Salvando e lendo dados em arquivos de maneira simplificada

## Instalação

Instale File and Path usando o **Composer**

```bash
  composer update
```

## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  vendor/bin/phpunit tests --colors -v --stop-on-failure --stop-on-warning --testdox
```

## Funcionalidades

-   **Cria um caminho caso ainda não exista**

```php
File::createPathIfNotExists(
    string $path
): void
```

-   **Salva um texto em um arquivo**

```php
File::saveFile(
    string $filename,
    string $content,
    bool $update=false
): void
```

-   **Salva um array em um arquivo JSON**

```php
File::saveOnJsonFile(
    string $filename,
    array $dataStructure
): void
```

-   **Salva um array em um arquivo .ENV**

```php
File::saveOnDotEnvFile(
    string $filename,
    array $dataStructure
): void
```

-   **Lê um arquivo e retorna o conteúdo como texto**

```php
File::readFile(
    string $filename
): string
```

-   **Lê um arquivo JSON e retorna o conteúdo como um array**

```php
File:readJsonFile(
    string $filename
): array
```

-   **Lê um arquivo .ENV e retorna o conteúdo como um array**

```php
File:readFromDotEnvFile(
    string $filename
): array
```

## Exceções
