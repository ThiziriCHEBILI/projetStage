import { useState, type JSX } from "react";
import YouTube, { type YouTubeEvent } from "react-youtube";
import { Modal } from "../Modal/Modal";
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
  const [player, setPlayer] = useState<YouTubeEvent["target"] | null>(null);

  async function handlePause(event: YouTubeEvent): Promise<void> {
    const seconds = await event.target.getCurrentTime();
    onSave(seconds);
  }

  async function handleClose(): Promise<void> {
    if (player) {
      const seconds = await player.getCurrentTime();
      onSave(seconds);
    }
    onClose();
  }

  return (
    <Modal title={title} boxType="video" onClose={handleClose}>
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
        onReady={(event) => setPlayer(event.target)}
        onEnd={async (event) => onSave(await event.target.getDuration())}
      />
    </Modal>
  );
}
