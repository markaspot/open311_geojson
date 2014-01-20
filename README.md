# Open311 GeoReport2GeoJSON Converter

This code converts a list of geoReport requests into geoJSON.
You can pass the endpoint as host parameter and some limit to the server.

To run the code with curl in a webserver's context and save the geoJSON to disk:

```
$ curl http://localhost/?host=anliegen.bonn.de -o anliegen.bonn.geojson
```

## Contact

Holger Kreis
Twitter @markaspot
http//www.mark-a-spot.org