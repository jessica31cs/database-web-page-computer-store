import MySQLdb
import math
import sys

def combinations(lst, accum, tempLst, l, r, lstLen):
    if len(tempLst) == lstLen:
        accum.append(tempLst)
        return accum
    while l < r:
        combinations(lst, accum, tempLst + [lst[l]], l+1, r, lstLen)
        l+=1
    return accum

def nextList(dbList, oldList, supp):
    C = {}
    L = []
    for lst in dbList:
        for itemLst in oldList:
            i = 0
            for item in itemLst:
                if item in lst:
                    i+=1
            if i == len(itemLst):
                if tuple(itemLst) not in C:
                    C[tuple(itemLst)] = 1
                else:
                    C[tuple(itemLst)] += 1
    print('Freq:',C)

    for val in C:           #removing those with freq<2 and add to new list = L
        if C[val] > supp:
            L.append(list(val))
    #print('L', L)
    return L

def uniqueVals(oldLst): #initally dbList and changes as elimination occurs
    unique = []
    for lst in oldLst:
        for item in lst:
            if item not in unique:
                unique.append(item)
    return unique
        
#-------------------------------------------------------------------
def apriori(s):
    supp = float(s)
    db = MySQLdb.connect(host='localhost', user='cs288', passwd='CS288.pass', db='cs634')
    #print(db)

    cursor = db.cursor()
    s = "select * from db5"
    cursor.execute(s)
    tuples = cursor.fetchall()
    #---------------------------------------------------------------------
    db = []
    for i in tuples:            #puts info from db into a 2d list
        items = i[1].split()
        db.append(items)
    #db = [['B','C'],['B','C','D'],['A','D'],['A','B','C','D'],['C','D'],['C','D','E'],['A','B']]
    #db = [['A','B','C','E'],['A','B','E'],['A','D'],['A','B','D'],['B','D','E']]
    #db = [['A','C','D'],['B','C','E'],['A','B','C','E'],['B','E']]
    #db = [['I1','I2','I3'],['I2','I4'],['I2','I3'],['I1','I2','I4'],['I1','I3'],['I2','I3'],['I1','I3'],['I1','I2','I3','I5'],['I1','I2','I3']]
    #---------------------------------------------------------------------
    a = db #should be set to original lst from db
    support = len(uniqueVals(a))*supp
    itemset = 1
    while len(a)>1:
        vals = uniqueVals(a)
        print('vals', len(vals), vals)
        combos = combinations(vals, [], [], 0, len(vals), itemset)
        print('C',len(combos), combos)
        a = nextList(db, combos, support) #frequency scanned and removed
        print('L', len(a), a)
        itemset +=1
        print('')
    print('final:',a)
#---------------------------------------------------------------------
if len(sys.argv) == 2:
    apriori(sys.argv[1])
elif len(sys.argv) < 2:
    print('too little arguments: add a support')
else:
    print('too many arguments')
