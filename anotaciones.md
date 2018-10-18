# anotaciones

## traer acciones

trae todas las de un pais:

```sql
SELECT accion.*, pais.pais FROM accion INNER JOIN pais ON accion.id_pais = pais.id_pais AND pais.pais=?
```