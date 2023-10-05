import request from '../request'

export async function getAllSales() {
  return await request('GET', '/sale')
}
