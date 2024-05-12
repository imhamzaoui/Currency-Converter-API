
# Currency Converter 

The Currency Converter API project aims to provide a web service for converting currencies based on real-time exchange rates. The API allows users to retrieve the current exchange rates between different currencies and perform currency conversions using these rates.


## API Reference

#### Get all items

```http
  GET /api/register
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `action:register` | `string` | **Required**. params |
| `pwd` | `string` | **Required**. The Secret key |

#### Get item

```http
  GET /api/items/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `id`      | `string` | **Required**. Id of item to fetch |

#### add(num1, num2)

Takes two numbers and returns the sum.

