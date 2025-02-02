..  include:: /Includes.rst.txt

.. _start:

=======
CHF Map
=======

:Extension key:
    chf_map

:Package name:
    digicademy/chf_map

:Version:
    |release|

:Language:
    en

:Author:
    `Jonatan Jalle Steller <mailto:jonatan.steller@adwmainz.de>`__,
    CHF Map contributors

:License:
    This document is published under the
    `CC BY 4.0 <https://creativecommons.org/licenses/by/4.0/>`__
    license.

:Rendered:
    |today|

----

This TYPO3 extension implements a data model for map tiles and features as well
as simple coordinates and geographical token distributions, as part of the
Cultural Heritage Framework (CHF). Geographical features are stored (and
serialised) as `GeoJSON <https://datatracker.ietf.org/doc/html/rfc7946>`__.
The extension also acts as a wrapper for `MapLibre GL JS <https://maplibre.org/maplibre-gl-js/docs>`__
and provides a plugin to show individual features or groups of features as
content elements in the frontend. Integrators may further specify the map tiles
they want to display as a base map.

----

**Table of contents:**

..  toctree::
    :maxdepth: 2
    :titlesonly:

    Introduction/Index
    InstallAndConfig/Index
    EditingContent/Index
    Templates/Index
    DataModel/Index
    ApiReference/Index
    Maintenance/Index

..  Meta Menu

..  toctree::
    :hidden:

    Sitemap
