import type { JSX } from "react";
import "./VideoModal.scss";

interface VideoModalProps {
  url: string;
  title: string;
  startAt: number;
  onClose: () => void;
}

export function VideoModal({
  url,
  title,
  startAt,
  onClose,
}: VideoModalProps): JSX.Element {
  return (
    <div className="video-modal" onClick={onClose}>
      <div
        className="video-modal__content"
        role="dialog"
        aria-modal="true"
        aria-label={title}
        onClick={(event) => event.stopPropagation()}
      >
        <button
          type="button"
          className="video-modal__close"
          onClick={onClose}
          aria-label="Fermer la vidéo"
        >
          <i className="fa-solid fa-xmark" aria-hidden="true"></i>
        </button>

        <iframe
          src={`${url}?autoplay=1&start=${startAt}`}
          title={title}
          className="video-modal__player"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowFullScreen
        />
      </div>
    </div>
  );
}
