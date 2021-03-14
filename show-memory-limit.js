'use strict'

const v8 = require('v8')

// console.log(v8.getHeapStatistics())


const totalHelpSize = v8.getHeapStatistics().total_available_size
let totalHelpSizeInGB = (totalHelpSize / 1024 / 1024 / 1024).toFixed(2)

console.log(`Total heap size (byte) ${totalHelpSize},(GB ~${totalHelpSizeInGB})`)
