
# Currency Converter (tunisian dinar)

The Currency Converter API project aims to provide a web service for converting currencies based on real-time exchange rates. The API allows users to retrieve the current exchange rates between different currencies and perform currency conversions using these rates.


## Features

- **Anti-DDoS Protection:** Implemented measures to mitigate distributed denial-of-service (DDoS) attacks, ensuring the API remains available and responsive under heavy traffic conditions.
- **Form Validation:** Incorporates comprehensive form validation mechanisms to ensure data integrity and prevent malicious input, enhancing the security and reliability of currency conversion requests.
- **Database Connectivity:** Establishes a secure connection to the database to store and manage exchange rate data, enabling efficient retrieval and updating of currency information as needed.


## API Reference

#### Get New API Key

```http
  GET /API/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `action` | `string` | **Required**. Specify “register” to generate a new API key. |
| `pwd` | `string` | **Required**. The Secret key. |
| `name` | `string` | **Required**. App Name. |
| `email` | `string` | **Required**. Email. |

#### Get Supported Currencies List

```http
  GET /API/api.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `apiKey`      | `string` | **Required**. Your API key. |
| `action`      | `string` | **Required**. Specify “supportedCurrencies” to get a list of supported currencies. |


#### Convert Currencies
```http
  GET /API/api.php
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `apiKey`      | `string` | **Required**. Your API key. |
| `action`      | `string` | **Required**. Specify “convert” to convert currencies. |
| `from`      | `string` | **Required**. The source currency. |
| `to`      | `string` | **Required**. The target currency. |
| `amount`      | `int` | **Required**. Amount of currency to convert. |



#### Get Supported Currencies List
```http
  GET /api/items/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |


#### Params

**"register"**\
**"supportedCurrencies"** \
**"convert"** 


## Authors

- [@imhamzaoui](https://www.github.com/imhamzaoui)


![Logo](https://media.istockphoto.com/id/955491538/photo/flag-of-tunisia.jpg?s=612x612&w=0&k=20&c=N8zUtTM_cT9n8EvTDVFdhXYAZolE26UkBvBVKOnLBkc=)

