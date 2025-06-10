import globalState from '@/api'; 

export function hasPermission(permission) {
  return globalState.permissions.includes(permission);
}
