import { signOut } from './auth'

const baseURL = import.meta.env.VITE_API_BASE_URL

function getHeaders() {
  const token = localStorage.getItem('token')
  return {
    'Content-Type': 'application/json',
    Accept: 'application/json',
    ...(token && {
      Authorization: `Bearer ${token}`
    })
  }
}

async function request(method, url, body) {
  const options = {
    method,
    headers: getHeaders(),
    ...(method !== 'GET' && {
      body: JSON.stringify(body)
    })
  }

  const response = await fetch(baseURL + url, options)

  if (response.status === 401) {
    signOut()
  }

  return await response.json()
}

export { request as default, request, getHeaders }
