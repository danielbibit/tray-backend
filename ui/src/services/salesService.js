import request from '../request'

export async function getAllSales() {
  return await request('GET', '/sale')
}

export async function createSale(seller_id, price) {
  const year = new Date().getFullYear()
  const month = new Date().getMonth() + 1
  const day = new Date().getDate()

  const date_string = year + '-' + month + '-' + day;

  const request_body = {
    "seller_id": seller_id,
    "price": Number(price).toFixed(2),
    "sale_date": date_string
  }

  return await request('POST', '/sale', request_body)
}
