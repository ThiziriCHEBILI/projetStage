import type { JSX } from "react";
import "./ErrorMessage.scss";

interface ErrorMessageProps {
  message: string;
}

export function ErrorMessage({ message }: ErrorMessageProps): JSX.Element {
  return (
    <p className="error-message" role="alert">
      {message}
    </p>
  );
}
