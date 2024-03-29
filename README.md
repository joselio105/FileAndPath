![Logo](https://github.com/joselio105/FileAndPath/assets/8493620/997b2841-f3bf-497d-aaea-736f8ad84b9c)

![GitHub release (release name instead of tag name)](https://img.shields.io/github/v/release/joselio105/fileandpath?include_prereleases)
![GitHub](https://img.shields.io/github/license/joselio105/FileAndPath)
![PHP](https://img.shields.io/badge/PHP-7.4.33-blue)
![PHP Unit](https://img.shields.io/badge/depencencies-PHPUnit9.6-yellowgreen)

Salvando e lendo dados em arquivos de maneira simplificada

## Menu

-   [Instalação como Dependência](#instalação-como-dependência)
    -   [Diretamente pelo Composer](#diretamente-pelo-composer)
    -   [Alterando o arquivo composer.json](#alterando-o-arquivo-composerjson)
-   [Rodando os Testes](#rodando-os-testes)
-   [Funcionalidades](#funcionalidades)
-   [Exceções](#exceções)

## Instalação como dependência

Instale File and Path usando o **Composer**

### Diretamente pelo Composer

```bash
  composer require plugse/fileandpath
```

### Alterando o arquivo composer.json

1. Crie ou altere o arquivo composer.json
2. Crie ou altere a propriedade **require**

```json
{
    "require": {
        "plugse/fileandpath": "^1"
    }
}
```

3. Atualize a biblioteca com o comando abaixo:

```bash
    composer update
```

## Rodando os testes

Para rodar os testes, rode o seguinte comando

```bash
  composer run-script post-install-cmd
```

## Funcionalidades

-   **Cria um caminho caso ainda não exista**

```php
File::createPathIfNotExists(
    string $path
): void
```

-   **Salva um array em um arquivo JSON**

```php
Json::Save(
    string $filename,
    array $dataStructure
): void
```

-   **Salva um array em um arquivo .ENV**

```php
Env::save(
    string $filename,
    array $dataStructure
): void
```

-   **Salva um array em um arquivo de LOG**

```php
Log::save(
    string $filename,
    array $dataStructure
): void
```

-   **Lê um arquivo JSON e retorna o conteúdo como um array**

```php
Json::read(
    string $filename
): array
```

-   **Lê um arquivo .ENV e retorna o conteúdo como um array**

```php
Env::read(
    string $filename
): array
```

-   **Lê um arquivo de LOG e retorna o conteúdo como um array**

```php
Log::read(
    string $filename
): array
```

## Exceções

-   FileAlreadyExists

-   FileNotFound
