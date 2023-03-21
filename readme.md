# Symfony VarDumper Decorator

## Purpose

Symfony's [VarDumper](https://symfony.com/doc/current/components/var_dumper.html) component is great, but when using it in a stand-alone context, it does not show the file and line number the dump is coming from. Adding this package as a dev requirement will add that functionality to your dumps.

In addition, some configuration is required to use the [dump server](https://symfony.com/doc/current/components/var_dumper.html#the-dump-server) when using VarDumper as a stand-alone component. This package automatically sets that up.

## Usage

### Installation

```sh
composer require --dev buzzingpixel/symfony-var-dumper-decorator
```

Now when you call `dump()` or `dd()`, you'll get file and line number context with your dumps. And if you start the dump server, your dumps should automatically connect.

### Configuration

Configuration is controlled by `env`.

#### `VAR_DUMPER_THEME`

Because the author of this package prefers light themes, the default is `light`. You can set this env variable to `dark` to get VarDumper's dark theme.

##### `VAR_DUMPER_SERVER_ADDRESS`

This defaults to `tcp://127.0.0.1:9912` but if you need to change this for any reason, you can do so with this environment variable.
