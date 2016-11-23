# Elastic Search Sample Application

## Installation

To install:

* Clone/checkout the repository
* Do a `composer install`

You're all set!

## Software Requirements

* PHP 5.5.9 or later
* Apache 2.4.x
* Curl - latest stable
* Elastic Search Server

## Installation of elastic search server
Use the following link to install elastic search server
https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-elasticsearch-on-ubuntu-14-04

## Installation of other pulgins
Phonetic Search - 
https://www.elastic.co/guide/en/elasticsearch/guide/current/phonetic-matching.html

Attachment Types 
https://www.elastic.co/guide/en/elasticsearch/reference/1.3/mapping-attachment-type.html

##Admin Panel for Elastic Search 
https://github.com/royrusso/elasticsearch-HQ

## Installing JAVA

##Installing OpenJDK

`sudo apt-get update`

`sudo apt-get install openjdk-7-jre`

verify your JRE is installed
	`java -version`

The result should look like this:

Output of java -version
java version "1.7.0_79"
OpenJDK Runtime Environment (IcedTea 2.5.6) (7u79-2.5.6-0ubuntu1.14.04.1)
OpenJDK 64-Bit Server VM (build 24.79-b02, mixed mode)

##Installing Java 8

Add the Oracle Java PPA to apt:
	`sudo add-apt-repository -y ppa:webupd8team/java`

Update your apt package database:
	`sudo apt-get update`

Install the latest stable version of Oracle Java 8 (and accept the license agreement that pops up)
    `sudo apt-get -y install oracle-java8-installer`

verify it is installed:
    `java -version`


##cURL calls

Get the list of nodes - 
curl -XGET 'localhost:9200/_cat/nodes?v&pretty'

Get the list of indices - 
curl -XGET 'localhost:9200/_cat/indices?v&pretty'

Index a document - 
curl -XPUT 'localhost:9200/index_name/type_name/id(optional)?pretty&pretty' -d'
{
  "field_name": "your_data"
}'

Get the indexed document - 
curl -XGET 'localhost:9200/index_name/type_name/id?pretty&pretty'

Delete an index  - 
curl -XDELETE 'localhost:9200/index?pretty&pretty'

Modify data in a document - 
curl -XPUT 'localhost:9200/index_name/type_name/id?pretty&pretty' -d'
{
  "field_name": "modified data"
}'

Update a document - 
curl -XPOST 'localhost:9200/index_name/type_name/id/_update?pretty&pretty' -d'
{
  "field_name": { "field_name": "modified data", "field_name": "modified data" }
}'

Delete a documents - 
curl -XDELETE 'localhost:9200/index_name/type_name/id?pretty&pretty'

Search - 
curl -XGET 'localhost:9200/index_name/_search?pretty' -d'
{
  "query": {
    "bool": {
      "must": [
        { "match": { "field": "search_data" } },
        { "match": { "field": "search_data" } }
      ]
    }
  }
}'

Aggregations - 
curl -XGET 'localhost:9200/index_name/type_name/_search?pretty' -d'
{
    "size" : 0,
    "aggs" : { 
        "custom_name" : { 
            "terms" : { 
              "field" : "field_name"
            }
        }
    }
}'
