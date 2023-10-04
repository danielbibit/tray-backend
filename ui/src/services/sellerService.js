import request from "../request";

export async function getAllSellers() {
  return await request("GET", "/seller");
}
