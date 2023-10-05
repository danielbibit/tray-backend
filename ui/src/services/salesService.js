import request from '../request'

export async function getAllSales() {
  return await request('GET', '/sale')
}

export async function createSale(seller_id, price) {
  // console.log(new Date().parse('Y-m-d'))
  const request_body = {
    "seller_id": seller_id,
    "price": Number(price).toFixed(2),
    "sale_date": "2023-10-05"
  }

  return await request('POST', '/sale', request_body)
}
