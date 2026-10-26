export const API_URL = "http://localhost:8000";

type Method = "GET" | "POST" | "PUT" | "DELETE";

export async function fetchAPI<T>(
  endpoint: string,
  method: Method = "GET",
  data?: unknown,
  token?: string,
): Promise<T | undefined> {
  const result = await fetchAPIWithStatus<T>(endpoint, method, data, token);
  return result.data;
}

export interface ApiResult<T> {
  ok: boolean;
  status: number;
  data: T | undefined;
}

export async function fetchAPIWithStatus<T>(
  endpoint: string,
  method: Method = "GET",
  data?: unknown,
  token?: string,
): Promise<ApiResult<T>> {
  const headers: Record<string, string> = {};

  if (data) {
    headers["Content-Type"] = "application/json";
  }

  if (token) {
    headers["Authorization"] = `Bearer ${token}`;
  }

  try {
    const response = await fetch(`${API_URL}/${endpoint}`, {
      method,
      headers,
      body: data ? JSON.stringify(data) : undefined,
    });

    const json = await response.json();

    return { ok: response.ok, status: response.status, data: json };
  } catch (e) {
    console.error(e);
    return { ok: false, status: 0, data: undefined };
  }
}
