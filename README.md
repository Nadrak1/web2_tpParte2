Requerimientos NO Funcionales OBLIGATORIOS
Se debe adjuntar documentación de los endpoints generados en el README.md del repositorio. Es decir, una descripción de cada endpoint, como se usan y ejemplos. Entender que esta documentación la va a leer otro desarrollador para entender como se consume la API.

![image](https://user-images.githubusercontent.com/103833940/201802044-65e43f4c-ace8-4e42-97f7-1dbc5f2f6152.png)

                                                          ENDPOINTS

1- GET

uri: http://localhost/WEB2_TpPart2/api/videogame
Endpoint:GET
Parametros:Ninguno
body:No tenemos que ingresar nada en el body
Para utilizarlo el get de todos los elementos debemos simplemente especificar lo que queremos ver que es videogame.
Muestra todos los datos de la tabla videogame y algunos de category ya que hice un inner JOIN
![image](https://user-images.githubusercontent.com/103833940/201801945-1dbff12c-eb17-4cab-96c0-cb473812b710.png)

2-GET POR ID:Muestra un elemento de nuestra tabla ya que por parametro recibimos un ID,

uri:http://localhost/WEB2_TpPart2/api/videogame/4
Endpoint: GET
Parametro: El id
body: Ninguno ya que no tenemos que ingresar datos
Para utilizarlo el get por id tenemos que agregar la "/" y seguido de un numero de id
![image](https://user-images.githubusercontent.com/103833940/201802096-ba4aa203-c277-4a3e-8e8f-af21d1257ce9.png)

3-POST

uri: http://localhost/WEB2_TpPart2/api/videogame
Endpoint: POST
Parametro: ninguno,ya que no estamos accediendo a un elemento en especifico para editar/borrar o ver
body: tenemos que poner en formato JSON todos los atributos,ya que si dejamos un campo vacio nos dara error
Para utilizarlo tenemos que ir al RAW en el body y introducir dato por dato en fomato json de todos nuestros atributos MENOS EL ID ya que lo tenemos especificado como autoincremental
![image](https://user-images.githubusercontent.com/103833940/201802201-e2028cb9-da91-4aa1-ba95-b4aaf6f7876b.png)
![image](https://user-images.githubusercontent.com/103833940/201802281-fe092466-df1e-4a66-b3d1-d07feb98eb02.png)

4-PUT
uri: http://localhost/WEB2_TpPart2/api/videogame/48
Endpoint: PUT
Parametro: el id ya que lo necesitamos especificar en el uri para saber cual modificar
body: tenemos que poner en formato JSON todos los atributos,ya que si dejamos un campo vacio nos dara error.
Para utilizarlo tenemos que ir al RAW en el body y introducir dato por dato en fomato json de todos nuestros atributos MENOS EL ID ya que lo tenemos especificado en el uri
![image](https://user-images.githubusercontent.com/103833940/201802370-a3c2e402-78b2-4303-9b73-fab3a1a85fe4.png)

5-DELETE
uri: http://localhost/WEB2_TpPart2/api/videogame/46
Endpoint: DELETE
Parametro: el id ya que lo necesitamos especificar en el uri para saber cual eliminar
body: ninguno.Ya que simplemente tenemos que introducir el nro de id en el uri del elemento que queremos eliminar y listo
![image](https://user-images.githubusercontent.com/103833940/201802599-a936e680-1c92-4bb9-8873-8de76a51702f.png)

6-ORDER BY
uri: http://localhost/WEB2_TpPart2/api/videogame?sort=id&order=DESC
Endpoint: GET
Parametro: el sort que especificamos por cual atributo queremos ordenar y el ORDER que decimos de que manera
body: ninguno.Pero en el params debemos especificar en KEY el parametro y en value el valor por el cual buscar

![image](https://user-images.githubusercontent.com/103833940/201802648-64a041de-5888-437a-a40c-5a8ab18b71bd.png)
![image](https://user-images.githubusercontent.com/103833940/201802684-f01e75a5-a9f9-4b7e-bcb0-2c95ce2e6396.png)

7-PAGINACION
uri: http://localhost/WEB2_TpPart2/api/videogame?starAt=2&endAt=5
Endpoint: GET
Parametro: El startAt(va a ser un numero que especifica por donde arranca) y el endAt(va a ser un numero que especifica por donde termina),
body: ninguno.Pero en el params debemos especificar en KEY el parametro y en value el valor por el cual buscar

![image](https://user-images.githubusercontent.com/103833940/201802722-52479230-c892-4502-bad2-afdd1f7fae00.png)

7-PAGINACION Y ORDERBY
uri: http://localhost/WEB2_TpPart2/api/videogame?sort=id&order=desc&starAt=1&endAt=2
Endpoint: GET
Parametro: el sort que especificamos por cual atributo queremos ordenar y el ORDER que decimos de que manera y el startAt(va a ser un numero que especifica por donde arranca) y el endAt(va a ser un numero que especifica por donde termina),
body: ninguno.Pero en el params debemos especificar en KEY el parametro y en value el valor por el cual buscar de los 4 

![image](https://user-images.githubusercontent.com/103833940/201802722-52479230-c892-4502-bad2-afdd1f7fae00.png)
