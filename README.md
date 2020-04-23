# Paginator

A PHP service that creates a pagination control structure for a list of items. The library operates with any form of traversable list or collection and produce a data structure that defines a set of pagination parameters.


## Install
```shell script
> composer require johnd/paginator
``` 

## Usage
```php
$input = ['alpha', 'beta', 'delta', 'gamma'];
$perPage = 2;
$pageNumber = 1;

$collection = new IterableCollection($input);
$paginator = new Paginator($collection, $perPage);

$result = $paginator->paginate($pageNumber);
```

### Notes
For paginating a database result set, see the \Collections\DbCollection example. Unlike the IterableCollection the DbCollection does not require you to pass the populated collection to the constructor, only the database connection. 

Then implement getSubset() to lazy load a single page of records on each paginate() call. This will be more efficient when dealing with large result sets.

To paginate any other type of dataset, simply create a class that implements CollectionInterface

