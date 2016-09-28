UPGRADE
=======

Upgrading from 0.3 to 0.4
-------------------------

* The `SerializerRegistry` class is now final. If you need custom behavior
  inside the serializer registry, create your own implementation of the
  `SerializerRegistryInterface`.
