import type { JSX } from "react";
import YouTube from "react-youtube";
import "./VideoModal.scss";

interface VideoModalProps {
  youtubeId: string;
  title: string;
  startAt: number;
  onClose: () => void;
}

export function VideoModal({
  youtubeId,
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

        <YouTube
          videoId={youtubeId}
          title={title}
          iframeClassName="video-modal__player"
          opts={{
            width: "100%",
            height: "100%",
            playerVars: { autoplay: 1, start: startAt },
          }}
        />
      </div>
    </div>
  );
}
