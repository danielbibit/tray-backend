import request from './request';

export async function signIn (email, password) {
  const { token } = await request('POST', '/login', {
    email,
    password,
    'device_name': 'SPA',
  });

  localStorage.setItem('token', token);
}

export function signOut () {
  localStorage.removeItem('token');
}

export function isSignedIn () {
  const token = localStorage.getItem('token');

  if (!token)     // Se não existe o token no LocalStorage
    return false; // significa que o usuário não está assinado.

  return true;
}
