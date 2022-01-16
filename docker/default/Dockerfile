ARG TLR_IMG
FROM ${TLR_IMG}
MAINTAINER Paweł Tomulik <ptomulik@meil.pw.edu.pl>

ARG TLR_USER='tailor'
ARG TLR_GROUP='tailor'
ARG TLR_UID=6789
ARG TLR_GID=6789
ARG TLR_HOME=/home/${TLR_USER}
ARG TLR_CODE=/code

ENV TLR_USER=$TLR_USER \
    TLR_GROUP=$TLR_GROUP \
    TLR_UID=$TLR_UID \
    TLR_GID=$TLR_GID \
    TLR_HOME=$TLR_HOME \
    TLR_CODE=$TLR_CODE

RUN if [ -f /etc/alpine-release ]; then \
      addgroup -g $TLR_GID $TLR_GROUP && \
      adduser -h $TLR_HOME -G $TLR_GROUP -u $TLR_UID -D $TLR_USER; \
    else \
      groupadd -g $TLR_GID $TLR_GROUP && \
      useradd -m -d $TLR_HOME -g $TLR_GROUP --uid $TLR_UID $TLR_USER; \
    fi; \
    mkdir -p $TLR_CODE && chown $TLR_USER:$TLR_GROUP $TLR_CODE

VOLUME $TLR_CODE

WORKDIR $TLR_CODE

# vim: set ft=dockerfile:
