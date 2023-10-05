import request from '../request'

export async function sendSellerReport(seller_id) {
  const request_body = {
    "seller_id": seller_id,
  }

  return await request('POST', '/report/sellerReport', request_body)
}
