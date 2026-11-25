import type { JSX, ReactNode } from "react";
import "./Modal.scss";

interface ModalProps {
  title: string;
  boxType: "video" | "card";
  onClose: () => void;
  children: ReactNode;
}

export function Modal({
  title,
  boxType,
  onClose,
  children,
}: ModalProps): JSX.Element {
  return (
    <div
      className="modal"
      onClick={(event) => {
        if (event.target === event.currentTarget) {
          onClose();
        }
      }}
    >
      <div
        className={`modal__box modal__box--${boxType}`}
        role="dialog"
        aria-modal="true"
        aria-label={title}
      >
        <button
          type="button"
          className={`modal__close modal__close--${boxType}`}
          aria-label="Fermer"
          onClick={onClose}
        >
          <i className="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>

        {children}
      </div>
    </div>
  );
}
