package main

import "log"

func main() {
	err := startApp()
	if err != nil {
		log.Fatalf("App failed to start: %v", err)
	}
}
