export const API_URL = "http://localhost:8000";

type Method = "GET" | "POST" | "PUT" | "DELETE";

export async function fetchAPI<T>(
  endpoint: string,
  method: Method = "GET",
  data?: unknown,
  token?: string,
): Promise<T | undefined> {
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

    if (response.ok) {
      return await response.json();
    } else {
      const error = await response.json();
      return error;
    }
  } catch (e) {
    console.error(e);
  }
}
