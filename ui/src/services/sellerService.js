import request from '../request'

export async function getAllSellers() {
  return await request('GET', '/seller')
}

export async function createSeller(name, email) {
  const request_body = {
    "name": name,
    "email": email
  }

  return await request('POST', '/seller', request_body)
}
