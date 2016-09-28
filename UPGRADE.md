UPGRADE
=======

Upgrading from 0.3 to 0.4
-------------------------

* The serializer implementation has been separated from its API definition.
  This package now no longer ships with an implementation.

  The Symfony Serializer component integration has been moved to the separate
  [php-xapi/symfony-serializer package](https://github.com/php-xapi/symfony-serializer).

  A default implementation of the `SerializerRegistryInterface` is still part
  of the `php-xapi/serializer` package though.

  This package ships with the following interfaces that must be implemented
  by packages that want to provide the xAPI serialization functionality:

  * `ActorSerializerInterface`
  * `DocumentDataSerializerInterface`
  * `StatementResultSerializerInterface`
  * `StatementSerializerInterface`
  * `StatementFactoryInterface`

  Implementors of the API provided by this package are advised to add the
  `php-xapi/serializer-implementation` package to the `provide` section of
  their `composer.json` file.

  The `Tests` subnamespace of this package contains a set of base abstract
  PHPUnit test classes integrators can use to make sure that their implementation
  adheres to the API specified by the `php-xapi/serializer` package.

* The `SerializerRegistry` class is now final. If you need custom behavior
  inside the serializer registry, create your own implementation of the
  `SerializerRegistryInterface`.
