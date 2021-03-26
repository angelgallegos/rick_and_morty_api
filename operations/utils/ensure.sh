#!/usr/bin/env bash

# Ensure a command is available

function ensure() {
  local missing=0
  for bin in "$@"
  do
    if [ ! $(command -v $bin) ]; then
      echo_error "$bin is not installed on this system"
      missing=$((missing+1))
    fi
  done
  if [ $missing -gt 0 ]; then
    echo "missing"
  else
    echo ""
  fi
}