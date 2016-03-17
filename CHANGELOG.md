CHANGELOG
=========

0.2.0
-----

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
