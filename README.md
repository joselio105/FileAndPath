# File and Path

Salvando e lendo dados em arquivos de maneira simplificada

## Menu

- [Instalação como Dependência](#instalação-como-dependência)
- [Dependências](#dependências)
- [Rodando os Testes](#rodando-os-testes)
- [Funcionalidades](#funcionalidades)
- [Exceções](#exceções)

## Instalação como dependência

Instale File and Path usando o **Composer**

```bash
  composer update
```

## Dependências



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

-   **Lê um arquivo e retorna o conteúdo como texto**

```php
File::readFile(
    string $filename
): string
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
