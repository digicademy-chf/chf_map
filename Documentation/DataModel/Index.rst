..  include:: /Includes.rst.txt

..  _data-model:

==========
Data model
==========

All records of a resource are held together by a single ``MapResource`` which
holds the main classes ``Feature``, ``Tag``, and ``Tile``. The core class
``Feature`` can hold GeoJSON information to describe various geometries such as
points, line strings, polygons, multi points, multi line strings, multi
polygons, or geometry collections.

Each ``MapResource`` may specify a number of ``Tile`` objects it wants to map
its data onto. The data model itself does not check whether the tiles are
available and whether you are allowed to use them. Some providers limit the
number of requests per day or month, for example. In addition, please note that
the tiles added here may require you to add a notice to your website's privacy
policy about requests being made to external servers.

``Coordinates`` and ``Distribution`` classes are available for other data
models to easily describe exact locations and geographic token distributions,
respectively.

In addition, the model knows flexible ``LabelTag`` and ``SameAs`` classes,
which can be used to group features via labels and to connect entities to
authority files.

..  _graphical-overview:

Graphical overview
==================

..  figure:: /DataModel/DataModel.png
    :alt: Data model of the extension
    :target: ../_images/DataModel.png
    :class: with-shadow

    Overview of the extension's data model. Check the :ref:`api-reference`
    for further details.
