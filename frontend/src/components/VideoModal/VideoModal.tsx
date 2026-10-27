import type { JSX } from "react";
import YouTube, { type YouTubeEvent } from "react-youtube";
import "./VideoModal.scss";

interface VideoModalProps {
  youtubeId: string;
  title: string;
  startAt: number;
  onSave: (seconds: number) => void;
  onClose: () => void;
}

export function VideoModal({
  youtubeId,
  title,
  startAt,
  onSave,
  onClose,
}: VideoModalProps): JSX.Element {
  async function handlePause(event: YouTubeEvent): Promise<void> {
    const seconds = await event.target.getCurrentTime();
    onSave(seconds);
  }

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
          onPause={handlePause}
        />
      </div>
    </div>
  );
}
