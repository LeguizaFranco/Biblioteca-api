<p align="center">
  <img src="https://media.giphy.com/media/YGlRW1Am9q7e0/giphy.gif?cid=790b7611ed4jjj3c9eb3tunu4inkn97kwjhg509of8r11t1u&ep=v1_gifs_search&rid=giphy.gif&ct=g" alt="Animación de Libros" width="300">
</p>


### 📚 Proyecto: Sistema de Gestión de Biblioteca

---

**Integrantes, Grupo Nº 98:**
- GIL, MARIA AGUSTINA (43658954)
- LEGUIZA, FRANCO (44928045)

---

### Temática

Este proyecto tiene como objetivo la **gestión de libros y géneros** en una biblioteca. A través de esta API, los usuarios podrán:

- Consultar y gestionar información sobre **libros**.
- Consultar y gestionar información sobre **géneros**.

---

### URL De ejemplo 
`./api/endpoint/:ID/:subrecurso`

---

## 🚀 Endpoints

### **Libros**  

#### **1. Obtener todos los libros**  
- **Endpoint**: `GET /api/books`  
- **Descripción**: Devuelve una lista de todos los libros disponibles en la base de datos.  
- **Ejemplo de solicitud**:  
  ```http
  GET /api/books
  ```
- **Respuesta exitosa** (`200`):  
  ```json
  [
    {
      "id": 3,
      "titulo": "El resplandor",
      "sinopsis": "Jack Torrance acepta un trabajo como vigilante de invierno en el aislado Hotel Overlook, donde su familia se enfrenta a fuerzas sobrenaturales que desatan la locura en Jack. La historia explora la interacción entre la psique humana y lo paranormal.",
      "autor": "Stephen King",
      "anio_publicacion": 1977,
      "id_genero": 1,
      "imagen_url": "https://e00-elmundo.uecdn.es/elmundo/imagenes/2011/09/29/cultura/1317286638_extras_ladillos_1_0.jpg"
    }
  ]
  ```
- **Error** (`500`):  
  ```json
  {
    "error": "Error al obtener los libros"
  }
  ```

---

#### **2. Obtener un libro por ID**  
- **Endpoint**: `GET /api/books/:ID`  
- **Descripción**: Devuelve los detalles del libro correspondiente al `ID` especificado.  
- **Ejemplo de solicitud**:  
  ```http
  GET /api/books/7
  ```
- **Respuesta exitosa** (`200`):  
  ```json
  {
    "id": 7,
    "titulo": "Harry Potter y la piedra filosofal",
    "sinopsis": "Harry Potter, un joven mago huérfano, descubre que es un mago y empieza su aventura en la escuela de magia Hogwarts, donde enfrenta desafíos y descubre secretos sobre su pasado.",
    "autor": "J. K. Rowling",
    "anio_publicacion": 1997,
    "id_genero": 4,
    "imagen_url": "https://beta-content.tap-commerce.com.ar/cover/original/9788498388909_1.jpg?id_com=1169"
  }
  ```
- **Error** (`404`):  
  ```json
  {
    "error": "No existe el libro con el id=7"
  }
  ```

---

#### **3. Crear un libro**  
- **Endpoint**: `POST /api/books`  
- **Descripción**: Crea un nuevo libro con los datos proporcionados.  
- **Cuerpo de la solicitud**:  
  ```json
  {
    "titulo": "Fahrenheit 451",
    "sinopsis": "La descripcion es opcional",
    "autor": "Ray Bradbury",
    "anio_publicacion": 1953,
    "id_genero": 2,
    "imagen_url": "https://example.com/fahrenheit.jpg"
  }
  ```
- **Respuesta exitosa** (`201`):  
  ```json
  {
    "message": "Libro creado con éxito",
    "id": 3
  }
  ```
- **Errores** (`400`):  
  ```json
  {
    "error": "Faltan datos requeridos"
  }
  ```
    > **Nota**: El campo `id` se genera automáticamente y no debe incluirse en el JSON.

---

#### **4. Actualizar un libro**  
- **Endpoint**: `PUT /api/books/:ID`  
- **Descripción**: Modifica un libro existente identificado por el `ID`.  
- **Cuerpo de la solicitud**:  
  ```json
  {
    "titulo": "Fahrenheit 451 (Edición Actualizada)"
  }
  ```
- **Respuesta exitosa** (`200`):  
  ```json
  {
    "message": "Libro actualizado con éxito"
  }
  ```
- **Errores** (`404`):  
  ```json
  {
    "error": "No existe el libro con el id=3"
  }
  ```

---

#### **5. Eliminar un libro**  
- **Endpoint**: `DELETE /api/books/:ID`  
- **Descripción**: Elimina el libro identificado por el `ID`.  
- **Ejemplo de solicitud**:  
  ```http
  DELETE /api/books/2
  ```
- **Respuesta exitosa** (`200`):  
  ```json
  {
    "message": "Libro eliminado con éxito"
  }
  ```
- **Errores** (`404`):  
  ```json
  {
    "error": "No existe el libro con el id=2"
  }
  ```

---

### **Géneros**  

#### **1. Obtener todos los géneros**  
- **Endpoint**: `GET /api/genres`  
- **Descripción**: Devuelve una lista de todos los géneros  disponibles en la base de datos.  
- **Ejemplo de solicitud**:  
  ```http
  GET /api/genres
  ```
- **Respuesta exitosa** (`200`):  
  ```json
  [
    {
      "id": 1,
      "genero": "terror",
      "descripcion": "El género de terror busca evocar miedo, horror o tensión en el lector a través de situaciones sobrenaturales, monstruos, psicópatas o escenarios oscuros y espeluznantes.",
      "generos_relacionados": "Fantasía, Misterio, Suspenso.",
      "nivel_popularidad": 8
    },
    {
      "id": 3,
      "name": "poesía",
      "descripcion": "La poesía es una forma literaria caracterizada por la expresión estética de sentimientos, emociones e ideas mediante el ritmo, la métrica y el verso, utilizando un lenguaje cuidadosamente seleccionado.",
      "generos_relacionados": "Literatura Clásica, Filosofía.",
      "nivel_popularidad": 6
    }
  ]
  ```
- **Error** (`500`):  
  ```json
  {
    "error": "Error al obtener los géneros"
  }
  ```

---

#### **2. Obtener un género por ID**  
- **Endpoint**: `GET /api/genres/:ID`  
- **Descripción**: Devuelve los detalles del género correspondiente al `ID` especificado.  
- **Ejemplo de solicitud**:  
  ```http
  GET /api/genres/1
  ```
- **Respuesta exitosa** (`200`):  
  ```json
  {
      "id": 1,
      "genero": "terror",
      "descripcion": "El género de terror busca evocar miedo, horror o tensión en el lector a través de situaciones sobrenaturales, monstruos, psicópatas o escenarios oscuros y espeluznantes.",
      "generos_relacionados": "Fantasía, Misterio, Suspenso.",
      "nivel_popularidad": 8
    }
  ```
- **Error** (`404`):  
  ```json
  {
    "error": "No existe el género con el id=1"
  }
  ```

---

#### **3. Crear un género**  
- **Endpoint**: `POST /api/genres`  
- **Descripción**: Crea un nuevo género con los datos proporcionados.  
- **Cuerpo de la solicitud**:  
  ```json
  {
      "genero": "Neofantástico",
      "descripcion": "Este género propone nuevas formas de concebir la realidad. (La descripcion es opcional)",
      "generos_relacionados": "Ciencia, Filosofia.",
      "nivel_popularidad": 2
    }
  ```
- **Respuesta exitosa** (`201`):  
  ```json
  {
    "message": "Género creado con éxito",
    "id": 3
  }
  ```
- **Errores** (`400`):  
  ```json
  {
    "error": "Faltan datos requeridos"
  }
  ```
  > **Nota**: El campo `id` se genera automáticamente y no debe incluirse en el JSON.

---

#### **4. Actualizar un género**  
- **Endpoint**: `PUT /api/genres/:ID`  
- **Descripción**: Modifica un género existente identificado por el `ID`.  
- **Cuerpo de la solicitud**:  
  ```json
  {
    "genero": "Aventura y Fantasía"
  }
  ```
- **Respuesta exitosa** (`200`):  
  ```json
  {
    "message": "Género actualizado con éxito"
  }
  ```
- **Errores** (`404`):  
  ```json
  {
    "error": "No existe el género con el id=3"
  }
  ```

---

#### **5. Eliminar un género**  
- **Endpoint**: `DELETE /api/genres/:ID`  
- **Descripción**: Elimina el género identificado por el `ID`.  
- **Ejemplo de solicitud**:  
  ```http
  DELETE /api/genres/2
  ```
- **Respuesta exitosa** (`200`):  
  ```json
  {
    "message": "Género eliminado con éxito"
  }
  ```
- **Errores** (`404`):  
  ```json
  {
    "error": "No existe el género con el id=2"
  }
  ```

---

### 🌐 Estructura del Proyecto

Este proyecto cuenta con una API REST que permite la consulta, modificación, eliminación e inserción de **libros** y **géneros** en una biblioteca. El diseño está orientado a facilitar la **gestión de la colección literaria** y la **organización de géneros**.

---
