..  include:: /Includes.rst.txt

..  _introduction:

============
Introduction
============

The extension allows you to build comprehensive support for maps and image
maps into your TYPO3 project. Map resources may include a few simple features
on a single map all the way to a multitude of feature collections available
in the same map with multiple available tiles users can choose from. To
produce an image map instead of a regular one, simply include an image file
in the map resource and set the projection of the feature(s) to ``Pixels``
instead of the default ``World Geodetic System (WGS 84/EPSG 4326)``. The
extension uses Leaflet to display maps on the web, which automatically
translates geographic coordinates to a Pseudo-Mercator projection (EPSG 3857).
Map resources can also be made available as GeoJSON as the extension's data
model is based on this standard.

..  attention::

    The extension does not currently include a generic frontend template. To
    use it, you may thus need (someone with) knowledge of how templating works
    in TYPO3.

..  _screenshots:

Screenshots
===========

TBD
