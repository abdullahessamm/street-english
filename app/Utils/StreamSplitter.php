<?php

namespace App\Utils;

class StreamSplitter {
	private $streamResource;
	private int $chunkSize;
	private int|null $streamLength; // in bytes

	/**
     *
     * @param resource $streamResource
     * @param int $chunkSize
     * @param int $streamLength
     */
	public function __construct($streamResource, int $chunkSize, int|null $streamLength = null)
	{
		$this->streamResource = $streamResource;
		$this->chunkSize = $chunkSize;
		$this->streamLength = $streamLength;
	}

	public function getStreamLength(): int
	{
		return $this->streamLength ?? strlen(stream_get_contents($this->streamResource));
	}

	public function numOfChunks(): int
	{
		return (int) ceil(($this->getStreamLength() / $this->chunkSize));
	}

	public function getChunks(): array
	{
		$stream = stream_get_contents($this->streamResource);
		$chunks = [];
		$currentChunk = 0;
		$numOfChunks = $this->numOfChunks();

		while ($numOfChunks > 0)
		{
			$availableBytes = $this->getStreamLength() - ($this->chunkSize * $currentChunk);
			$chunkSize = $availableBytes < $this->chunkSize ? $availableBytes : $this->chunkSize;
			
			$chunks[] = stream_get_contents($this->streamResource, $availableBytes, $this->chunkSize * $currentChunk);
			$currentChunk++;
			$numOfChunks--;
		}

		return $chunks;
	}
}