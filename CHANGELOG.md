CHANGELOG
=========

0.2.x (next version)
-----

* Added support for (de)serializing 'created' and 'stored' Statement properties.

0.2.1
-----

* The object type is now optional. When the `objectType` key is omitted while an
  object is deserialized, it is to be assumed that the type of the denormalized
  object is activity.

* Empty PHP arrays are now dumped as JSON objects instead of empty lists.

* fixed the key of the mbox SHA1 sum property when denormalizing actors

* fixed deserializing incomplete agent objects that are missing the required
  IRI (the `ActorNormalizer` wil now throw an exception)

* add a `FilterNullValueNormalizer` that prevents `null` values from being
  serialized

* empty group member lists are not normalized, but the property will be omitted

* ignore nullable result properties when they are not set during normalization
  and denormalization

0.2.0
-----

* made the package compatible with version 0.2 of the `php-xapi/model` package

* replaced the JMS Serializer with the Symfony Serializer component

0.1.1
-----

* restrict dependency versions to not pull in potentially BC breaking package
  versions

0.1.0
-----

First release leveraging the JMS serializer library to convert xAPI model
objects into JSON strings confirming to the xAPI specs and vice versa.

This package replaces the `xabbuh/xapi-serializer` package which is now deprecated
and should no longer be used.
